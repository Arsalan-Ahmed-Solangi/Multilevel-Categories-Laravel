<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = "category_id";
    protected $fillable =
    [
        'category_name',
        'parent_category',
    ];

    //***Start of Fetching Parent Category If belongs ********//
    public function parentCategories()
    {
        //Get Name of Parent Category of Each Sub Category
        return $this->belongsTo(Category::class,'parent_category');
    }
    //***End of Fetching Parent Category  If belongs *******//

    //**Start of Fetching Child Category If Exits******//
    public function childCategories()
    {
        // Get Nested Categories if Parent Category Have
        return $this->hasMany(Category::class,'parent_category');
    }
    //**End of Fetching Child Category If Exits*******//
}
