<?php

use App\Modules\ParametersModule\Parameter;
use App\Modules\ParameterValueModule\ParameterValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class ParameterValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pivot_parameter_value = [];
        $parameters = Config::get('parameters.parameters');
        foreach ($parameters as $key => $data) {
            $parameter = Parameter::create([
                'reference' => $key,
                'name' => $data['name'] ?? '',
                'description' => $data['description'] ?? '',
                'editable' => $data['editable'] ?? 0
            ]);
            $values = $data['values'] ?? [];
            if(isset($data['is_children'])) {
                foreach ($values as $key => $items) {
                    $parent_id = $pivot_parameter_value[$key]->id;
                    foreach ($items as $value) {
                        $parameter_value = ParameterValue::create([
                            'parameter_id' => $parameter->id,
                            'parent_id' => $parent_id ?? NULL,
                            'name' => $value
                        ]);
                        if(isset($data['has_children'])) {
                            $pivot_parameter_value[$value] = $parameter_value;
                        }
                    }
                }
            } else {
                foreach ($values as $value) {
                    $parameter_value = ParameterValue::create([
                        'parameter_id' => $parameter->id,
                        'name' => $value
                    ]);
                    if(isset($data['has_children'])){
                        $pivot_parameter_value[$value] = $parameter_value;
                    }
                }
            }
        }
    }
}
