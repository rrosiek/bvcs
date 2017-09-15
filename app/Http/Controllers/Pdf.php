<?php

namespace App\Http\Controllers;

use App\Content;
use Dompdf\Dompdf;
use View;

class Pdf extends Controller
{
    /**
     * @param  string $slug
     * @return \Dompdf\Canvas
     */
    public function show($slug) 
    {
        $pdf = new Dompdf();
        $content = Content::where('slug', $slug)->first();

        if ($content->type !== 'newsletter')
            return abort(404);

        $html = View::make('pdf.newsletter', compact('content'))->render();
        $pdf->loadHtml($html);
        $pdf->render();

        return $pdf->stream(sprintf("BVCS %s.pdf", $content->title));
    }
}
