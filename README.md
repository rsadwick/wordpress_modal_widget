# Gravity Forms Modal Widget for Wordpress
### Developed by Grace Family Church

This widget interacts with Gravity forms - forms are rendered in a modal and use gravity form javascript events and ajax features to interact with the form.

- In Gravity forms, give your form a css class name
- When using a Gravity Form shortcode, enable ajax: 
```
[gravityform id="1" ajax="true"]
```
- Within your html element you want to trigger the modal, give it a class called **gfc-form-modal**.
- Within the same element, give it a data-type attribute.  Within that attribute, reference the css class you gave the form.  The complete html example is below:

```html
<a class="gfc-form-modal" href="#" data-type="some-class-from-gravity-forms">Open Form Modal</a>
```
