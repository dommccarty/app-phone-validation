# app-phone-validation

This library lets you use Twilio to validate phone numbers that users enter into your app, for both iPhone and Android.

Your app first posts to ```validate_phone_number_1.php```, which sets everything up including sending the SMS. Then after your user opens the app by clicking on the validation link, post to ```validate_phone_number_2.php```.

```generate_5_digits.php``` shows how to generate random-looking 5-digit strings consisting of upper and lowercase letters, and numbers. Very lightweight, doesn't repeat for the first trillion iterations (or so). You can easily use the same method to get random-looking strings of any length.

```base_helpers.php``` contains ```convert_to_base_array```, a useful function for representing positive integers with respect to an arbitrary base.
