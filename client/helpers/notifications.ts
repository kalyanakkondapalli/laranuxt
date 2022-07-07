import { Notification } from 'element-ui'

/**
 * success notification
 * @param {String} message
 * @param {String} title
 */
export function successNotification (message: string, title = 'Success') {
  Notification.success({
    title,
    message,
  })
}

/**
 * error notification
 * @param {String} message
 * @param {String} title
 */
export function errorNotification (message: string, title = 'Error') {
  Notification.error({
    title,
    message,
  })
}
