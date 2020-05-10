import {h, render} from 'preact'
import {Report} from '../components/Forum/Report'
import {$$} from '@fn/dom'
import MessageCreate from '../components/Forum/MessageCreate'

document.addEventListener('turbolinks:load', function () {

  $$('.js-report').forEach(report => {
      render(
        h(Report, {
          endpoint: report.dataset.endpoint,
          data: JSON.parse(report.dataset.data)
        }),
        report
      )
  })

  $$('#new-forum-message').forEach(element => {
    render(h(MessageCreate, {
      topic: parseInt(element.dataset.topic, 10)
    }), element.parentElement, element)
  })

})
