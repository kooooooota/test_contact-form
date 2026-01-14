@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
  <div class="confirm__heading">
    <h2>Confirm</h2>
  </div>
  <form class="confirm-form" action="/thanks" method="post">
    @csrf
    <div class="confirm-table">
      <table class="confirm-table__inner">
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text">
            <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
            <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            @php
                $genderLabels = [
                    '1' => '男性',
                    '2' => '女性',
                    '3' => 'その他',
                ];
            @endphp
            <input type="text" name="genderlabels" value="{{ $genderLabels[$contact['gender']] }}" readonly />
            <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">
            <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">
            <input type="tel" name="tel" value="{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">
            <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">建物名</th>
          <td class="confirm-table__text">
            <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">
            <input type="text" name="content" value="{{ $category['content'] }}" readonly />
            <input type="hidden" name="category_id" value="{{ $category['id'] }}">
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせ内容</th>
          <td class="confirm-table__text">
            <textarea name="detail" rows="5" cols="20" readonly>{{ $contact['detail'] }}</textarea>
          </td>
        </tr>
      </table>
    </div>
    <div class="confirm-form__button">
      <button class="confirm-form__button-submit" type="submit">送信</button>
      <a class="modify-form__button" href="/">修正</a>
    </div>
</form>
</div>
@endsection
