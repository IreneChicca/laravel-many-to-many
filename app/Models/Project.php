<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


    protected $fillable = ['title','date','main_lang','commit','bonus','type_id'];



    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
    public function getTechBadges(){

        $badges = "";
        foreach($this->technologies as $technology){

            $badges .="<span class='badge mx-1' style='background-color:{$technology->color}'>{$technology->label}</span>";
        }

        return $badges;
        
    }

}