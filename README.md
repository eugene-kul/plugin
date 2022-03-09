## Plugin for displaying and moderating reviews on the site

> Frontend of the plugin supports only **Russian language**. But each component can be expanded, and the fields can be renamed as you wish.

---

Optional, but to nicely display the post review button in the review list, you need to add styles to:

> *Settings* - *Customize back-end* - *Styles*

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

### Start using the plugin

For the plugin to work, you need to connect standard styles and scripts in the template or on the page:

```bash
# in the tag head:
{% styles %}

# at the end of the tag body:
{% framework extras %}
{% scripts %}
```

You need to connect the components and insert them in the right place in the code

```bash
{% component 'ReviewForm' %}
{% component 'ReviewList' %}
```

---

The feedback submission form must have the following attributes:
```bash
data-request="onSaveReview"
data-request-files
data-request-success="sendReviews(this);"
data-request-error="noSendReviews(this);"
```