<?php 
    class Data_model {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllData()
        {
            $this->db->query("SELECT 
                                p.id_peminjam,
                                p.nama, 
                                p.kelas, 
                                b.nama_buku, 
                                p.tanggal_pinjam, 
                                p.tanggal_kembali,
                                p.status 
                            FROM 
                                peminjam AS p 
                            INNER JOIN 
                                buku AS b ON p.id_buku = b.id_buku");
            return $this->db->resultSet();
        }

        public function insertData($data)
        {
            $this->db->query("INSERT INTO 
                                peminjam
                            VALUES (
                                '',
                                :nama,
                                :kelas,
                                :id_buku,
                                NOW(),
                                DATE_ADD(NOW(), INTERVAL 10 DAY),
                                'pinjam'
                            )");
            $this->db->bind('nama', $data["nama"]);
            $this->db->bind('kelas', $data["kelas"]);
            $this->db->bind('id_buku', $data["id_buku"]);

            $this->db->execute();
            return $this->db->checkRow();
        }

        public function deleteData($id)
        {
            $this->db->query("DELETE FROM peminjam WHERE id_peminjam =:id");
            $this->db->bind('id', $id);
            $this->db->execute();
            return $this->db->checkRow();
        }

        public function getAllCategories()
        {
            $this->db->query("SELECT * FROM kategori");
            return $this->db->resultSet();
        }
    
        public function getBooksByCategory($id_kategori)
        {
            $this->db->query("SELECT * FROM buku WHERE id_kategori = :id_kategori");
            $this->db->bind(':id_kategori', $id_kategori);
            return $this->db->resultSet();
        }

        public function editStatus($status, $id)
        {
            $this->db->query("UPDATE peminjam SET status =:status WHERE id_peminjam =:id_peminjam");
            $this->db->bind('status', $status);
            $this->db->bind('id_peminjam', $id);
            $this->db->execute();
            return $this->db->checkRow();
        }
        
    }

?>