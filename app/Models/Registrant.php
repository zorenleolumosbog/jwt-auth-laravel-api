<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registrant extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblm_b_onboard_actreg_basic';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'reg_id';

    /**
     * The table associated with the model.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'reg_firstname', 
        'reg_middlename', 
        'reg_lastname', 
        'reg_birthdate',
        'reg_civilstatus',
        'reg_religion',
        'reg_addr_line1',
        'reg_addr_line2',
        'reg_addr_towncity',
        'reg_addr_state',
        'reg_country_code',
        'reg_pro_addr_line1',
        'reg_pro_addr_line2',
        'reg_pro_addr_towncity',
        'reg_pro_addr_state',
        'reg_pro_addr_country',
        'reg_datecreated',
        'reg_datemodified',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'reg_datecreated' => 'datetime',
        'reg_datemodified' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reg_link_preregid');
    }
}
