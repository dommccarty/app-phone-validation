# app-phone-validation

This library shows you how to use Twilio to validate a phone number that a user enters into your app.

The app posts to ```validate_phone_number_1.php```, which sets everything up including sending the SMS. You should also write a ```validate_phone_number_2.php```, which gets hit after your user opens the app by clicking on the validation link.

```generate_5_digits.php``` shows how to generates random-looking 5-digit strings consisting of upper and lowercase letters, and numbers. Very lightweight, doesn't repeat for the first trillion iterations (or so). You can easily use the same method to get random-looking strings of any length.

```base_helpers.php``` contains ```convert_to_base_array```, a useful function for representing positive integers with respect to an arbitrary base.
