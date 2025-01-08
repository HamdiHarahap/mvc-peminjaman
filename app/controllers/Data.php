<?php 
    class Data extends Controller {
        public function index() 
        {
            $data["title"] = "Data Peminjaman";
            $data["peminjam"] = $this->model('Data_model')->getAllData();
            $data["kategori"] = $this->model('Data_model')->getAllCategories();
            $selectedCategory = $_POST['kategori'] ?? null;
            if ($selectedCategory) {
                $data["buku"] = $this->model('Data_model')->getBooksByCategory($selectedCategory);
            } else {
                $data["buku"] = []; 
            }

            $this->view('templates/header', $data);
            $this->view('data/index', $data);
            $this->view('templates/footer');
        }

        public function insert() 
        {
            if($this->model('Data_model')->insertData($_POST) > 0) {
                header("Location: " . BASEURL . "/data");
            }
        }

        public function delete($id)
        {
            if($this->model('Data_model')->deleteData($id) > 0) {
                header("Location: " . BASEURL . "/data");
            }
        }

        public function edit_status($status, $id)
        {
            if($this->model('Data_model')->editStatus($status, $id) > 0) {
                header("Location: " . BASEURL . "/data");
            }
        }

        public function getBooksByCategory()
        {
            if (isset($_POST['id_kategori'])) {
                $id_kategori = $_POST['id_kategori'];
                $books = $this->model('Data_model')->getBooksByCategory($id_kategori);

                echo json_encode($books);
            }
        }
    }
?>