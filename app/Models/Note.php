<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  title="Note",
 *  @OA\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @OA\Property(
 *      property="name",
 *      type="string"
 *  ),
 *  @OA\Property(
 *      property="phone",
 *      type="string"
 *  )
 * ),
 *  @OA\Property(
 *      property="email",
 *      type="string"
 *  )
 * ),
 *  @OA\Property(
 *      property="birthdate",
 *      type="date"
 *  )
 * ),
 *  @OA\Property(
 *      property="photo",
 *      type="string"
 *  )
 * )
 */

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['name','company','phone','email','birthdate','photo'];
}
