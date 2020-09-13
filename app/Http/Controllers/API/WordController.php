<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Parser;
use App\Repositories\WordRepository;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function show(Request $request)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);
        $search = Parser::parse($request->text);
        $length = mb_strlen($request->text, 'utf8');
        $matches = WordRepository::search($search, $length);
        return $matches;
    }
}
