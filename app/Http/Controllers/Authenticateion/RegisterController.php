<?php

namespace App\Http\Controllers\Authenticateion;

class RegisterController
{
    /**
     * Gebruiker registratie
     *
     * een gebruiker kan een account aanmaken bij ons. als dit request successvol is krijgt de gebruiker een validatie code in de mail.
     * De validatie code moet naar de validate endpoint gepost worden voor dat het account actief wordt.
     * de gebruiker krijgt hier de meest basis rol.
     *
     * @bodyParam name string required volledige naam van de gebruiker.
     * @bodyParam email string required email address van de gebruiker.
     * @bodyParam password string required nieuw wachtwoord.
     * @bodyParam passwordConfirm string required nieuw wachtwoord bevestiging.
     *
     * @response 200 "success": {
     *  "message": "successs"
     * }
     *  @response 422 "error": {
     *  "code": 422,
     *  "message": "Invalid request."
     * }
     * @response 429  "error": {
     *  "code": 429,
     *  "message": "Too Many Attempts."
     * }
     */
    public function testRegister(){}

    /**
     * Nieuw wachtwoord instellen
     *
     * na het ontvangen van de mail met de validate code.
     * Deze moet door de gebruiker worden ingevoerd om te bevestigen dat die zij/haar account is
     *
     * @bodyParam validationCode string required deze code heeft de gebruiker in de mail gekregen.
     * @bodyParam email string required het email address die bij de code hoort.
     *
     * @response 200 "success": {
     *  "message": "account gevalideerd"
     * }
     *  @response 422 "error": {
     *  "code": 422,
     *  "message": "Invalid request."
     * }
     * @response 429  "error": {
     *  "code": 429,
     *  "message": "Too Many Attempts."
     * }
     */
    public function testValidateRegister(){}
}
