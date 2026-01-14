<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvDownloadController extends Controller
{
    public function downloadCsv(Request $request)
    {
        // 1. クエリをビルド（ここで一度 dd($query->toSql()) してSQLを確認するのも有効です）
        $query = Contact::with('category')
            ->CategorySearch($request->category_id)
            ->GenderSearch($request->gender)
            ->DateSearch($request->date)
            ->KeywordSearch($request->keyword);
        // 2. CSV出力処理へ
        return new StreamedResponse(function () use ($query) {
            $stream = fopen('php://output', 'w');
            fwrite($stream, "\xEF\xBB\xBF"); // BOM

            fputcsv($stream, ['姓', '名', '性別', 'メール', 'カテゴリ']);

            $genderLabels = ['1' => '男性', '2' => '女性', '3' => 'その他'];

            // cursor() を使って効率的に回す
            foreach ($query->cursor() as $contact) {
                fputcsv($stream, [
                    $contact->last_name,
                    $contact->first_name,
                    $genderLabels[$contact->gender] ?? '不明',
                    $contact->email,
                    $contact->category->content ?? '',
                ]);
            }
            fclose($stream);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);
    }


}
