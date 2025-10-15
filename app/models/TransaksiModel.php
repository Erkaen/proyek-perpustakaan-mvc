<?php

class TransaksiModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getTransaksiAktif() {
        $this->db->query("
            SELECT 
                transactions.id,
                users.nama as nama_peminjam,
                books.judul as judul_buku,
                transactions.tanggal_pinjam,
                transactions.tanggal_jatuh_tempo,
                transactions.status
            FROM transactions
            JOIN users ON transactions.user_id = users.id
            JOIN books ON transactions.book_id = books.id
            WHERE transactions.status != 'returned'
            ORDER BY transactions.tanggal_pinjam DESC
        ");
        return $this->db->resultSet();
    }

    public function pinjamBuku($data) {
        $tanggal_pinjam = date('Y-m-d');
        $tanggal_jatuh_tempo = date('Y-m-d', strtotime('+7 days')); 
        
        $this->db->query("
            INSERT INTO transactions (user_id, book_id, tanggal_pinjam, tanggal_jatuh_tempo, status)
            VALUES (:user_id, :book_id, :tanggal_pinjam, :tanggal_jatuh_tempo, 'borrowed')
        ");
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('book_id', $data['book_id']);
        $this->db->bind('tanggal_pinjam', $tanggal_pinjam);
        $this->db->bind('tanggal_jatuh_tempo', $tanggal_jatuh_tempo);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            $this->db->query("UPDATE books SET stok = stok - 1 WHERE id = :book_id");
            $this->db->bind('book_id', $data['book_id']);
            $this->db->execute();
            return $this->db->rowCount();
        }
        return 0;
    }
    
    public function kembalikanBuku($transaksi_id) {
        $this->db->query("SELECT book_id FROM transactions WHERE id = :id");
        $this->db->bind('id', $transaksi_id);
        $transaksi = $this->db->single();
        
        if (!$transaksi) {
            return 0; 
        }
        $book_id = $transaksi['book_id'];

        $this->db->query("
            UPDATE transactions 
            SET status = 'returned', tanggal_kembali = :tanggal_kembali 
            WHERE id = :id
        ");
        $this->db->bind('tanggal_kembali', date('Y-m-d'));
        $this->db->bind('id', $transaksi_id);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            $this->db->query("UPDATE books SET stok = stok + 1 WHERE id = :book_id");
            $this->db->bind('book_id', $book_id);
            $this->db->execute();
            return $this->db->rowCount();
        }
        return 0;
    }

    public function countHistory($options = []) {
        $query = "
            SELECT COUNT(transactions.id) as total
            FROM transactions
            JOIN users ON transactions.user_id = users.id
            JOIN books ON transactions.book_id = books.id
            WHERE 1
        ";

        if (!empty($options['search'])) {
            $query .= " AND (users.nama LIKE :search OR books.judul LIKE :search)";
        }
        if (!empty($options['status'])) {
            if ($options['status'] == 'borrowed') {
                $query .= " AND transactions.status = 'borrowed' AND CURDATE() <= transactions.tanggal_jatuh_tempo";
            } elseif ($options['status'] == 'overdue') {
                $query .= " AND transactions.status = 'borrowed' AND CURDATE() > transactions.tanggal_jatuh_tempo";
            } elseif ($options['status'] == 'returned') {
                $query .= " AND transactions.status = 'returned'";
            }
        }
        if (!empty($options['start_date']) && !empty($options['end_date'])) {
            $query .= " AND transactions.tanggal_pinjam BETWEEN :start_date AND :end_date";
        }

        $this->db->query($query);

        if (!empty($options['search'])) {
            $this->db->bind('search', '%' . $options['search'] . '%');
        }
        if (!empty($options['start_date']) && !empty($options['end_date'])) {
            $this->db->bind('start_date', $options['start_date']);
            $this->db->bind('end_date', $options['end_date']);
        }
        return $this->db->single()['total'];
    }

    public function getHistory($options = []) {
        $query = "
            SELECT 
                transactions.id,
                users.nama as nama_peminjam,
                books.judul as judul_buku,
                transactions.tanggal_pinjam,
                transactions.tanggal_jatuh_tempo,
                transactions.tanggal_kembali,
                CASE
                    WHEN transactions.status = 'returned' THEN 'returned'
                    WHEN CURDATE() > transactions.tanggal_jatuh_tempo THEN 'overdue'
                    ELSE 'borrowed'
                END as status
            FROM transactions
            JOIN users ON transactions.user_id = users.id
            JOIN books ON transactions.book_id = books.id
            WHERE 1
        ";
        
        if (!empty($options['search'])) {
            $query .= " AND (users.nama LIKE :search OR books.judul LIKE :search)";
        }
        if (!empty($options['status'])) {
            if ($options['status'] == 'borrowed') {
                $query .= " AND transactions.status = 'borrowed' AND CURDATE() <= transactions.tanggal_jatuh_tempo";
            } elseif ($options['status'] == 'overdue') {
                $query .= " AND transactions.status = 'borrowed' AND CURDATE() > transactions.tanggal_jatuh_tempo";
            } elseif ($options['status'] == 'returned') {
                $query .= " AND transactions.status = 'returned'";
            }
        }
        if (!empty($options['start_date']) && !empty($options['end_date'])) {
            $query .= " AND transactions.tanggal_pinjam BETWEEN :start_date AND :end_date";
        }
        
        $query .= " ORDER BY transactions.tanggal_pinjam DESC";

        if (isset($options['limit'])) {
            $query .= " LIMIT :limit OFFSET :offset";
        }

        $this->db->query($query);

        if (!empty($options['search'])) {
            $this->db->bind('search', '%' . $options['search'] . '%');
        }
        if (!empty($options['start_date']) && !empty($options['end_date'])) {
            $this->db->bind('start_date', $options['start_date']);
            $this->db->bind('end_date', $options['end_date']);
        }
        if (isset($options['limit'])) {
            $this->db->bind('limit', $options['limit'], PDO::PARAM_INT);
            $this->db->bind('offset', $options['offset'], PDO::PARAM_INT);
        }

        return $this->db->resultSet();
    }

    public function countTransaksiAktif() { 
        $this->db->query("SELECT COUNT(id) as total FROM transactions WHERE status!='returned'");
        return $this->db->single()['total'];
    }

    public function getTransaksiByUserId($userId) {
        $this->db->query("
            SELECT 
                books.judul as judul_buku,
                transactions.tanggal_pinjam,
                transactions.tanggal_jatuh_tempo
            FROM transactions
            JOIN books ON transactions.book_id = books.id
            WHERE transactions.user_id = :user_id AND transactions.status != 'returned'
            ORDER BY transactions.tanggal_pinjam DESC
        ");
        $this->db->bind('user_id', $userId);
        return $this->db->resultSet();
    }
}