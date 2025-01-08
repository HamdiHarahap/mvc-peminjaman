const modal = document.getElementById('modal')
const statusModal = document.getElementById('modalStatus')
const openModalButton = document.getElementById('openModalButton')
const closeModalButtonTop = document.getElementById('closeModalButtonTop')
const closeModalButtonBottom = document.getElementById('closeModalButtonBottom')
const secondaryActionButton = document.getElementById('secondaryActionButton')

openModalButton.addEventListener('click', () => {
	modal.classList.remove('closing')
	modal.showModal()
	modal.classList.add('showing')
})

closeModalButtonTop.addEventListener('click', closeModal)
closeModalButtonBottom.addEventListener('click', closeModal)
secondaryActionButton.addEventListener('click', () => {
	console.log('Secondary action executed')
})

function closeModal() {
	modal.classList.remove('showing')
	modal.classList.add('closing')
	modal.addEventListener(
		'animationend',
		() => {
			modal.close()
			modal.classList.remove('closing')
		},
		{ once: true }
	)
}
