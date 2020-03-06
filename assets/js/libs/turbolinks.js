import Turbolinks from 'turbolinks'

document.addEventListener('turbolinks:load', function () {
  const darkToggle = document.querySelector('#dark-toggle')
  if (darkToggle) {
    darkToggle.addEventListener('click', e => {
      e.stopPropagation()
      e.preventDefault()
      document.body.classList.toggle('dark')
    })
  }
})
Turbolinks.start()
