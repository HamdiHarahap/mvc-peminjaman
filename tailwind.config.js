/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./src/**/*.{html,js,php}', // Menambahkan ekstensi PHP
		'./**/*.php', // Memastikan semua file PHP di root atau subfolder ikut disertakan
	],
	theme: {
		extend: {},
	},
	plugins: [],
}
