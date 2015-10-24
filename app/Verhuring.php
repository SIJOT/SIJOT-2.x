<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * MySQL Database columns.
 *
 * @property mixed, Start_datum,    The start date of the rental.
 * @property mixed, Eind_datum,     The end date of the rental.
 * @property mixed, Groep,          The group or person who asks to rent the domain.
 * @property mixed, GSM,            The mobile number for the person or group.
 * @property mixed, Email,          The Email address for the person or group.
 * @property int,   status,         The status code of the rental.
 */
class Verhuring extends Model
{
    //
}
