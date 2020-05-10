
import '../css/app.scss'

import "./elements/AutoSubmit"
import "./elements/TimeAgo"
import './elements/Switch'
import './elements/Choices'
import './elements/Alert'
import './elements/Autogrow'
import './elements/Comments'
import './elements/DatePicker'
import './elements/DiffEditor'
import './elements/Modal'
import './elements/Switch'
import './elements/Tabs'
import './elements/Waves'
import './modules/animation'
import './modules/highlight'
import './elements/editor/index'
import './modules/scrollreveal'

import Choices from 'choices.js'
import {$$} from '@fn/dom'

document.addEventListener('turbolinks:load', function () {
    const darkToggle = document.querySelector('#dark-toggle')
    if (darkToggle) {
        darkToggle.addEventListener('click', e => {
            e.stopPropagation()
            e.preventDefault()
            document.body.classList.toggle('dark')
        })
    }

  // Choices
    $$('select[multiple]').forEach((s) => new Choices(s))
})
Turbolinks.start()
