<div class="px-32 py-12 bg-[#F2F9FE] min-h-screen">
    <h1 class="text-2xl font-bold">Data Peminjaman</h1>
    <button id="openModalButton" class="px-4 py-2 text-white bg-indigo-500 rounded my-4">
        Tambah Peminjam
    </button>

    <table class="border mr-4 w-full mt-4">
        <tr class="border text-left bg-blue-900 text-white">
            <th class="p-2">No</th>
            <th class="p-2">Nama</th>
            <th class="p-2">Kelas</th>
            <th class="p-2">Buku</th>
            <th class="p-2">Tangal Pinjam</th>
            <th class="p-2">Tanggal Wajib Kembali</th>
            <th class="p-2">Status</th>
            <th class="p-2">Aksi</th>
        </tr>
        <?php $no = 1 ?>
        <?php foreach($data["peminjam"] as $pjm): ?>
        <tr>
            <td class="py-4 ps-2"><?= $no++; ?></td>
            <td class="py-4 ps-2"><?= $pjm["nama"]; ?></td>
            <td class="py-4 ps-2"><?= $pjm["kelas"]; ?></td>
            <td class="py-4 ps-2"><?= $pjm["nama_buku"]; ?></td>
            <td class="py-4 ps-2"><?= $pjm["tanggal_pinjam"]; ?></td>
            <td class="py-4 ps-2"><?= $pjm["tanggal_kembali"]; ?></td>
            <td class="py-4 ps-2 text-white font-semibold">
                <?php if($pjm["status"] == 'pinjam'): ?>
                    <a href="<?= BASEURL; ?>/data/edit_status/<?= $pjm["status"] == "pinjam" ? "kembali" : "pinjam"; ?>/<?= $pjm["id_peminjam"]; ?>" class="bg-[#28a745] px-3 py-2 rounded-lg w-fit cursor-pointer" onclick="return confirm('Ganti status ke <?= $pjm['status'] == 'pinjam' ? 'kembali' : 'pinjam' ;?>')">
                        <?= $pjm["status"]; ?>
                    </a>
                <?php else: ?>
                    <a href="<?= BASEURL; ?>/data/edit_status/<?= $pjm["status"] == "kembali" ? "pinjam" : "kembali"; ?>/<?= $pjm["id_peminjam"]; ?>" class="bg-[#6c757d] px-3 py-2 rounded-lg w-fit cursor-pointer" onclick="return confirm('Ganti status ke <?= $pjm['status'] == 'pinjam' ? 'kembali' : 'pinjam' ;?>')">
                        <?= $pjm["status"]; ?>
                    </a>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?= BASEURL; ?>/data/delete/<?= $pjm["id_peminjam"]; ?>" onclick="return confirm('Anda yakin?')">
                    <img src="<?= BASEURL; ?>/images/trash.svg" alt="icon" class="w-10 bg-red-600 p-2 rounded-lg">
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>    
</div>

<dialog id="modal" class="relative p-6 bg-white rounded-lg shadow-lg w-[30rem]">
    <button id="closeModalButtonTop" class="close-button">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 hover:text-gray-900" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    <h2 class="mb-4 text-lg font-semibold">Ubah Status</h2>
    <form action="<?= BASEURL; ?>/data/insert" method="post" class="flex flex-col gap-3 mb-3">
        <div class="flex flex-col">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="border rounded-lg outline-none px-3 py-2">
        </div>
        <div class="flex flex-col">
            <label for="nim">NIM</label>
            <input type="number" id="nim" name="nim" class="border rounded-lg outline-none px-3 py-2">
        </div>
        <div class="flex flex-col">
            <label for="kelas">Kelas</label>
            <input type="text" id="kelas" name="kelas" class="border rounded-lg outline-none px-3 py-2">
        </div>
        <div class="flex flex-col">
            <label for="kategori">Kategori Buku</label>
            <select name="kategori" id="kategori" class="px-3 py-2 border rounded-lg">
                <option value="" disabled selected>-- Pilih Kategori --</option>        
                <?php foreach ($data["kategori"] as $kategori): ?>
                <option value="<?= $kategori['id_kategori']; ?>" <?= isset($_POST['kategori']) && $_POST['kategori'] == $kategori['id_kategori'] ? 'selected' : ''; ?>>
                    <?= $kategori['nama_kategori']; ?>
                </option>   
                <?php endforeach; ?>        
            </select>
        </div>
        <div class="flex flex-col">
            <label for="buku">Nama Buku</label>
            <select name="id_buku" id="buku" class="px-3 py-2 border rounded-lg">
                <option value="" disabled selected>-- Pilih Buku --</option>
            </select>
        </div>
        <div class="flex justify-end space-x-2">
            <button type="submit" class="px-4 py-2 text-white bg-indigo-500 rounded">
                Submit
            </button>
        </div>
    </form>

</dialog>

<script>
    document.getElementById('kategori').addEventListener('change', function () {
	const kategoriId = this.value

	fetch('<?= BASEURL; ?>/data/getBooksByCategory', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: `id_kategori=${kategoriId}`,
	})
		.then((response) => response.json())
		.then((data) => {
			const bukuDropdown = document.getElementById('buku')

			bukuDropdown.innerHTML =
				'<option value="" disabled selected>-- Pilih Buku --</option>'

			data.forEach((book) => {
				const option = document.createElement('option')
				option.value = book.id_buku
				option.textContent = book.nama_buku
				bukuDropdown.appendChild(option)
			})
		})
		.catch((error) => console.error('Error:', error))
})
</script>