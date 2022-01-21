# Installation wizard for October

Необходимо дополнительно установить плагин **Inetis.ListSwitch** из маркетплейса


> **Важно!** Если при отправки формы уходит заявка на почту!

В некоторых проектах есть функция handleRequestForms(), которая обрабатывает все формы, добавляя необходимые атрибуты, для отправки заявки.
Если такая форма есть, то в нее необходимо добавить условие, чтобы функция пропускала форму отправки отзывов. Например:

```bash
if(requestForm.hasAttribute('data-request')
   && requestForm.hasAttribute('data-request-success')
   && requestForm.hasAttribute('data-request-error')
   && !requestForm.hasAttribute('name')) {continue}
```

