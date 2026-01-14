@extends('layouts.app_auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('content')
<div class="admin-panel__content">
  <div class="admin-panel__heading">
    <h2>Admin</h2>
  </div>
    <form class="search-form" action="/search" method="get">
            <input type="text" class="search-form__item-input" name="keyword" value="{{ request('keyword') ?? old('keyword') }}" placeholder="名前やメールアドレスを入力してください">
            @csrf
            <select class="search-form__item-select-gender" name="gender">
                <option value="" {{ request('gender') == '' ? 'selected' : '' }} selected disabled hidden>性別</option>
                <option value="" {{ request('gender') == '' ? 'selected' : '' }} >全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
            <select class="search-form__item-select-content" name="category_id">
                <option value="" selected>お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category['id'] }}" {{ request('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                @endforeach
            </select>
            <input class="search-form__item-calender" type="date" name="date" value="{{ request('date') }}">
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
                <a class="search-form__button-submit" href="/admin">リセット</a>
            </div>
    </form>
    <div class="page">
        <form class="expt-btn" action="/csv-download" method="get">
            <button class="expt-btn-submit" type="submit" class="">エクスポート</button>
        </form>
        {{ $contacts->links() }}
    </div>
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header"></th>
                <th class="contact-table__header-name">お名前</th>
                <th class="contact-table__header-gender">性別</th>
                <th class="contact-table__header-email">メールアドレス</th>
                <th class="contact-table__header"></th>
                <th class="contact-table__header"></th>
                <th class="contact-table__header"></th>
                <th class="contact-table__header-content" colspan="2">お問い合わせの種類</th>
                <th class="contact-table__header"></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <div class="contact-table__item">
                    <td class="contact-table__text">
                        <input type="hidden" name="id" value="{{ $contact['id'] }}" readonly />
                    </td>
                    <td class="contact-table__text-name">
                        <div class="contact-table__text-last_name">
                            <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                        </div>
                        <div class="contact-table__text-first_name">
                            <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                        </div>
                    </td>
                    <td class="contact-table__text">
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
                    <td class="contact-table__text">
                        <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
                    </td>
                    <td class="contact-table__text">
                        <input type="hidden" name="tel" value="{{ $contact['tel'] }}" readonly />
                    </td>
                    <td class="contact-table__text">
                        <input type="hidden" name="address" value="{{ $contact['address'] }}" readonly />
                    </td>
                    <td class="contact-table__text">
                        <input type="hidden" name="building" value="{{ $contact['building'] }}" readonly />
                    </td>
                    <td class="contact-table__text">
                        <input type="text" name="content" value="{{ $contact['category']['content'] }}" readonly />
                    </td>
                    <td class="contact-table__text">
                        <textarea style="display: none;" name="detail" rows="5" cols="20" readonly>{{ $contact['detail'] }}</textarea>
                    </td>
                    <td class="open-modal-btn">
                        <button class="open-modal-btn-submit" 
                    data-last_name="{{ $contact->last_name }}" 
                    data-first_name="{{ $contact->first_name }}" 
                    data-gender="{{ $genderLabels[$contact['gender']] }}" 
                    data-email="{{ $contact->email }}" 
                    data-tel="{{ $contact->tel }}"
                    data-address="{{ $contact->address }}"
                    data-building="{{ $contact->building }}" 
                    data-content="{{ $contact['category']['content'] }}" 
                    data-detail="{{ $contact->detail }}">詳細</button>
                    </td>
                </div>
            </tr>
        @endforeach
        </table>
    </div>
</div>
<!-- modal -->
<dialog id="contactModal">
    <form method="dialog">
        <div class="close-btn">
            <button id="closeDialog">Close</button>
        </div>
        <div class="mdl-contact-table">
            <table class="mdl-contact-table__inner">
            <tr class="mdl-contact-table__row">
                <th class="mdl-contact-table__header">お名前</th>
                <td class="mdl-contact-table__text-name">
                    <input id="modal-last_name" type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                    <input id="modal-first_name" type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                </td>
            </tr>
            <tr class="mdl-contact-table__row">
                <th class="mdl-contact-table__header">性別</th>
                <td class="mdl-contact-table__text">
                @php
                    $genderLabels = [
                        '1' => '男性',
                        '2' => '女性',
                        '3' => 'その他',
                    ];
                @endphp
                <input id="modal-gender" type="text" name="genderlabels" value="{{ $genderLabels[$contact['gender']] }}" readonly />
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </td>
            </tr>
            <tr class="mdl-contact-table__row">
                <th class="mdl-contact-table__header">メールアドレス</th>
                <td class="mdl-contact-table__text">
                <input id="modal-email" type="email" name="email" value="{{ $contact['email'] }}" readonly />
                </td>
            </tr>
            <tr class="mdl-contact-table__row">
                <th class="mdl-contact-table__header">電話番号</th>
                <td class="mdl-contact-table__text">
                <input id="modal-tel" type="tel" name="tel" value="{{ $contact['tel'] }}" readonly />
                </td>
            </tr>
            <tr class="mdl-contact-table__row">
                <th class="mdl-contact-table__header">住所</th>
                <td class="mdl-contact-table__text">
                <input id="modal-address" type="text" name="address" value="{{ $contact['address'] }}" readonly />
                </td>
            </tr>
            <tr class="mdl-contact-table__row">
                <th class="mdl-contact-table__header">建物名</th>
                <td class="mdl-contact-table__text">
                <input id="modal-building" type="text" name="building" value="{{ $contact['building'] }}" readonly />
                </td>
            </tr>
            <tr class="mdl-contact-table__row">
                <th class="mdl-contact-table__header">お問い合わせの種類</th>
                <td class="mdl-contact-table__text">
                <input id="modal-content" type="text" name="content" value="{{ $contact['category']['content'] }}" readonly />
                </td>
            </tr>
            <tr class="mdl-contact-table__row">
                <th class="mdl-contact-table__header">お問い合わせ内容</th>
                <td class="mdl-contact-table__text">
                <textarea id="modal-detail" name="detail" rows="5" cols="20" readonly>{{ $contact['detail'] }}</textarea>
                </td>
            </tr>
            </table>
        </div>
    </form>
    <form class="delete-form" action="/delete" method="post">
        @method('DELETE')
        @csrf        
        <div class="delete-form__button">
            <input type="hidden" name="id" value="{{ $contact['id'] }}">
            <button class="delete-form__button-submit" type="submit">削除</button>
        </div>
    </form>
</dialog>
<script>
    // 画面の読み込みが終わってから実行させる
    window.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('contactModal');
        const modalLastName = document.getElementById('modal-last_name');
        const modalFirstName = document.getElementById('modal-first_name');
        const modalGender = document.getElementById('modal-gender');
        const modalEmail = document.getElementById('modal-email');
        const modalTel = document.getElementById('modal-tel');
        const modalAddress = document.getElementById('modal-address');
        const modalBuilding = document.getElementById('modal-building');
        const modalContent = document.getElementById('modal-content');
        const modalDetail = document.getElementById('modal-detail');
        
        const buttons = document.querySelectorAll('.open-modal-btn-submit');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // 1. ボタンの dataset から名前を取得
                const lastName = button.dataset.last_name;
                const firstName = button.dataset.first_name;
                const gender = button.dataset.gender;
                const email = button.dataset.email;
                const tel = button.dataset.tel;
                const address = button.dataset.address;
                const building = button.dataset.building;
                const content = button.dataset.content;
                const detail = button.dataset.detail;

                // 2. モーダルの中身を書き換える
                modalLastName.value = lastName;
                modalFirstName.value = firstName;
                modalGender.value = gender;
                modalEmail.value = email;
                modalTel.value = tel;
                modalAddress.value = address;
                modalBuilding.value = building;
                modalContent.value = content;
                modalDetail.value = detail;
                
                // 3. モーダルを表示
                modal.showModal();
            });
        });
    });
</script>
@endsection