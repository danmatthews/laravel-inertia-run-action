<?php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class RunActionController extends Controller
{

    // @TODO i broke this in the faffing about with the project.
    public function run(...$arguments)
    {
        $action = $this->transformActionNameToClassname(request("action_name"));
        if (class_exists($action)) {
            $action = new $action();
            $action->handle(...$arguments);
        } else {
            return response(status: 404);
        }
    }

    public function transformActionNameToClassname($action): string
    {
        return collect(explode(".", $action))
            ->map(fn($chunk) => Str::studly($chunk))
            ->prepend("App\\Actions")
            ->implode("\\");
    }
}
