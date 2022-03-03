@extends('layouts.app')

@section('title', __('manager.news.create.app-title'))

@section('content')
    <x-box>
        <x-slot name="title">{{ __('manager.news.create.title') }}</x-slot>
        <x-slot name="rightblock"></x-slot>
        <form action="{{ route("manager.news.store") }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-label-group mb-3">
                        <label class="form-label">{{ __('manager.news.create.news-title') }}</label>
                        <input type="text" name="news_title"
                               class="form-control @error('news_title') is-invalid @enderror"
                               value="{{ old('news_title') }}" min="5" required>
                    </div>
                </div>
                <div class="col-md-4 small align-self-center">
                    <p>{{ __('manager.news.create.news-title-desc') }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-label-group mb-3">
                        <label class="form-label">{{ __('manager.news.create.news-text') }}</label>
                        <textarea name="news_text" rows="10"
                                  class="form-control js-wysiwyg @error('news_title') is-invalid @enderror"
                                  required>{{ old('news_text') }}</textarea>
                    </div>
                </div>
                <div class="col-md-4 small align-self-top">
                    <p>{{ __('manager.news.create.news-text-desc') }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-label-group mb-3">
                        <label class="form-label">{{ __('manager.news.send') }}</label>
                        <select name="send_to" class="form-select" @error('send_to') is-invalid @enderror>
                            @foreach (\App\Models\News::$send_to_list as $i)
                                @if ($i!='user_cats')
                                    <option
                                        value="{{ $i }}" {{ (old('send_to') === $i) ? 'selected' : '' }}>@lang('manager.news.' . $i)</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 small">
                    <p>{{ __('manager.news.sendtohelp') }}</p>
                </div>
            </div>

            <div class="row group-recipients" data-type="all">
                <div class="col-md-12">
                    {{ __('manager.news.create.all-advertisers') }}
                </div>
            </div>

            <div class="row group-recipients" data-type="user_onbrd" style="display: none;">
                <div class="col-md-8">
                    <div class="form-label-group">
                        <label class="form-label">{{ __('manager.news.create.choose-onboarding-status') }}</label>
                        <select name="send_to_value" data-name="user_onbrd" class="form-select send_to_value">
                            <option value="">[{{ __('manager.news.create.not-chosen') }}]</option>
                            @foreach(\App\Lists\PpOnboardingList::getList() as $k=>$v)
                                <option value="{{ $k }}">{{ $k }} ({{ $v }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 small">
                    <p>{{ __('manager.news.useronbrdhelp') }}</p>
                </div>
            </div>

            <div class="row group-recipients" data-type="user_ids" style="display: none;">
                <div class="col-md-8">
                    <div class="form-label-group">
                        <label class="form-label">{{ __('manager.news.create.choose-range') }} USER ID</label>
                        <input name="send_to_value" type="text" data-name="user_ids" value="{{ old('send_to_value') }}"
                               pattern="[0-9.,- ]+" class="form-control send_to_value">
                    </div>
                </div>
                <div class="col-md-4 small">
                    <p>{{ __('manager.news.useridshelp') }}</p>
                </div>
            </div>

            <div class="row group-recipients" data-type="user_ids_exclude" style="display: none;">
                <div class="col-md-8">
                    <div class="form-label-group">
                        <label class="form-label">{{ __('manager.news.create.choose-range') }} USER ID</label>
                        <input name="send_to_value" type="text" data-name="user_ids_exclude"
                               value="{{ old('send_to_value') }}" pattern="[0-9.,- ]+"
                               class="form-control send_to_value">
                    </div>
                </div>
                <div class="col-md-4 small">
                    <p>{{ __('manager.news.useridsexhelp') }}</p>
                </div>
            </div>

            <div class="row group-recipients" data-type="user_tag" style="display: none;">
                <div class="col-md-8">
                    <div class="form-label-group">
                        <label class="form-label">{{ __('manager.news.create.choose-tag') }}</label>
                        <select name="send_to_value" data-name="user_tag" class="form-select send_to_value">
                            <option value="">[{{ __('manager.news.create.not-chosen') }}]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 small">
                    <p>{{ __('manager.news.usertaghelp') }}</p>
                </div>
            </div>


            <div class="mt-4">
                <button class="btn btn-primary" type="submit">{{ __('manager.news.create.submit') }}</button>
            </div>
        </form>
    </x-box>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $("[name=send_to]").change(function () {
                $(".group-recipients").hide();
                $(".send_to_value").attr('disabled', true);
                var v = $(this).val();
                $("[data-type=" + v + "]").show();
                $("[data-name=" + v + "]").attr('disabled', false);
            }).trigger('change');
        })
    </script>
@endsection

