<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class mapping các key filter vào query request
 */
abstract class QueryFilter {
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder) {
        $this->builder = $builder;

        foreach($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {  // nếu instance Filter có chứa method có tên là $name
                if (!empty($value)) {  // nếu tồn tại giá trị thì truyền giá trị vào param của funciton $name
                    $this->$name($value);
                } else {
                    $this->$name();     // nếu không tồn tại giá trị thì gọi function ko có param
                }
            }
        }

        return $this->builder;
    }

    public function filters() {
        return $this->request->all();  // lấy list param từ request
    }
}