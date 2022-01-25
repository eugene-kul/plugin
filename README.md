# Installation wizard for October

## Плагин для отображения и модерации отзывов на сайте

Для работы плагина требуется дополнительно установить плагин **Inetis.ListSwitch** из маркетплейса October CMS.

---
### Запуск плагина

Для работы плагина необходимо в шаблоне или на странице подключить стандартные стили и скрипты:

```bash
# в head:
{% styles %}

# в конце body:
{% framework extras %}
{% scripts %}
```

Далее, подключить компоненты и вставить их в нужное место в коде

```bash
{% component 'ReviewForm' %}
{% component 'ReviewList' %}
```

---

> **Важно!** Если при отправки формы уходит заявка на почту!

В некоторых проектах есть функция handleRequestForms(), которая обрабатывает все формы, добавляя(изменяя) необходимые атрибуты, для отправки заявки.
Если такая функция есть, то в нее необходимо добавить условие, чтобы функция пропускала форму отправки отзывов. Например:

```bash
if(requestForm.classList.contains('skip-forms')) {continue}
```

Форма отправки отзыва должна иметь следующие атрибуты:
```bash
data-request="onSaveReview"
data-request-files
data-request-success="sendMsg(this);"
data-request-error="noSendMsg(this);"
```

Для кастомной стилизации формы и отзыва, ниже предоставлены HTML структура для формы

```bash
<form>
   <div class="form-group-inputs">
      <div class="form-group-rating">
         <div class="ec-rating ec-clearfix rating-body" data-storage-id="ec-rating-resource-35">
            <div class="ec-rating-stars"> # для каждого span используется 3 активных класса active, active2, active-disabled
               <span data-rating="1" data-description="Плохо"> 
                  <svg></svg>
               </span>
               <span data-rating="2" data-description="Есть и получше">
                  <svg></svg>
               </span>
               <span data-rating="3" data-description="Средне">
                  <svg></svg>
               </span>
               <span data-rating="4" data-description="Хорошо">
                  <svg></svg>
               </span>
               <span data-rating="5" data-description="Отлично! Рекомендую!">
                  <svg></svg>
               </span>
            </div>
            <div class="ec-rating-description f13">Оцените по пятибальной шкале</div>
         </div>
      </div>
   </div>
   
   <div class="form-group-inputs">
      <label>
         <span>Имя<sup>*</sup></span>
         <input type="text" name="reviewName" autocomplete="off" value="" required placeholder="Ваше имя">
      </label>
      <label>
         <span>Контакты</span>
         <input type="text" name="reviewContscts" autocomplete="off" value="" placeholder="Телефон/E-mail">
      </label>
   </div>
   
   <label>
      <span>Текст отзыва<sup>*</sup></span>
      <textarea id="review_texteditor" name="reviewText" rows="8" value="" required></textarea>
   </label>
   <div class="form-group-inputs">
      <div class="file-input-body">
         <span>Размер одной фотографии не более 5 Мб. Максимальное количество фотографий: 7 шт.</span>
         <label for="file-1" class="file-input-label nofile js-input-files-label"> # после прикрепления файлов удаляется class nofile
            <span>Выберите фото</span>
            <div class="file-input-icon"><svg></svg></div>
            <input type="file" name="reviewFile[]" multiple id="file-1" size="1000" accept=".jpg,.jpeg,.webp,.png,.bmp" class="file-input js-input-files">
         </label>
         <div class="btn-del js-btn-del hide" title="Удалить файлы"></div> # после прикрепления файлов удаляется class hide
      </div>
   </div>
   <div class="reviews-form-info">Нажимая на кнопку, Вы даете согласие на обработку персональных данных, указанных на сайте. Контактные данные не будут отображены в отзыве, они нужны только для обратной связи.</div>
   <button class="btn-review btn-review-2" type="submit">Отправить</button>

   <div class="modal-success"> # после отправки отзыва присваивается class active
      <p class="modal-success__title">{{ SuccessSend }}</p>
      <p class="modal-success__icon">
         <svg></svg>
      </p>
   </div>
   <div class="modal-success-error"> # после отправки отзыва присваивается class active
      <p>{{ ErrorSend }}<br></p>
      <span class="btn-review" onclick="location.reload(false);">Обновить</span>
   </div>
</form>
```

HTML структура для списка отзывов

```bash
<div class="reviews-list">
   <ul class="revirews-list-body">
      <li>
         <div class="revirew-name-block">
            <div class="revirew-name">{{ item.name }}</div>
            <div class="revirew-rating">
               <svg></svg>
               <svg></svg>
               <svg></svg>
               <svg></svg>
               <svg></svg>
            </div>
            <span class="revirew-date">{{ item.date ? item.date|date_modify("+10 hours")|date('d.m.Y') : item.created_at|date('d.m.Y') }}</span> 
         </div>
         <div class="revirew-text">{{ item.text }}</div>
         <div>
            <a href="{{ image.path }}" class="review-image lightzoom">
               <img src="{{ image.thumb(120, 120, {'mode':'crop'}) }}" alt="{{ image.file_name }}" title="{{ image.file_name }}">
            </a>
         </div>
         <div class="review-reply">
            <i>Официальный ответ на отзыв:</i>
            <p> {{ item.reply }}</p>
         </div>
      </li>
   </ul>
   <ul class="pagination">
      <li class="disabled">
         <span>«</span>
      </li>
      <li class="active">
         <span>1</span>
      </li>
      <li>
         <a href="http://spec-omsk/otzyvy?page=2">2</a>
      </li>
      <li>
         <a href="http://spec-omsk/otzyvy?page=2" rel="next">»</a>
      </li>
   </ul>
</div>
```

Необязательно, но для красивого отображения кнопки публикации отзыва в списке отзывов, необходимо добавить стили в:

> *Настройки* - *Персонализация панели управления* - *Стили*

```bash
.center-text {text-align: center}

.list-cell-type-inetis-list-switch .oc-icon-check {
   background: #88b04b;
   padding: 1px 10px 2px;
}
.list-cell-type-inetis-list-switch .oc-icon-times {
   background: #ed6a5e;
   padding: 1px 12px 2px;
}
.list-cell-type-inetis-list-switch .oc-icon-check, .list-cell-type-inetis-list-switch .oc-icon-times {
   border: 1px solid #ccc;
   border-radius: 5px;
}
.list-cell-type-inetis-list-switch .oc-icon-check:before, .list-cell-type-inetis-list-switch .oc-icon-times:before {
   color: #fff;
   margin: 0;
}
```