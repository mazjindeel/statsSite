<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Uplink extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'uplink';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function players() {
		return $this->hasMany('App\Models\Models\UplinkPlayer', 'uplink_id', 'id');
	}
}