@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
    @csrf
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <div class="form__input--text-name">
                    <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
                </div>
                <div class="form__input--text-name">
                    <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}" />
                </div>
            </div>
            <div class="form__error">
                @error('last_name')
                {{ $message }}
                @enderror
                @error('first_name')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--radio">
                <input type="radio" id="male" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }} />
                <label for="male">男性</label>
                <input type="radio" id="female" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }} />
                <label for="female">女性</label>
                <input type="radio" id="other" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }} />
                <label for="other">その他</label>        
            </div>
            <div class="form__error">
                @error('gender')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <div class="form__input--text-tel">
                    <input type="tel" name="tel1" inputmode="numeric" pattern="[0-9]*" placeholder="080" value="{{ old('tel1') }}" />
                </div>
                    <span>-</span>
                <div class="form__input--text-tel">
                    <input type="tel" name="tel2" inputmode="numeric" pattern="[0-9]*" placeholder="1234" value="{{ old('tel2') }}" />
                </div>
                    <span>-</span>
                <div class="form__input--text-tel">
                    <input type="tel" name="tel3" inputmode="numeric" pattern="[0-9]*" placeholder="5678" value="{{ old('tel3') }}" />
                </div>
            </div>
            <div class="form__error">
                @if ($errors->any())
                    @foreach (array_unique(array_merge($errors->get('tel1'), $errors->get('tel2'), $errors->get('tel3'))) as $error)
                        {{ $error }}
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">建物名</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
            </div>
            <div class="form__error">
                @error('building')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--select">
                <select class="select" name="category_id" required>
                    <option value="" selected disabled hidden>選択してください</option>
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('content')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--textarea">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            </div>
            <div class="form__error">
                @error('detail')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="form__button">
        <button class="form__button-submit" type="submit">確認画面</button>
    </div>
    </form>
</div>
@endsection
