{{-- <x-app-layout>
@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
</x-app-layout> --}}
@extends('layouts.app')

@section('content')
    
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

<!-- Fonts -->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-md-12">
                <!-- الأقسام السابقة مثل إعدادات الحساب -->
                <!-- قسم تحديث كلمة المرور -->
                <div class="card mb-6">
                    <h5 class="card-header">تحديث كلمة المرور</h5>
                    <div class="card-body">
                        <form method="post" action="{{ route('password.update') }}" class="mt-6">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="update_password_current_password" class="form-label">كلمة المرور الحالية</label>
                                <input type="password" id="update_password_current_password" name="current_password" class="form-control" autocomplete="current-password">
                                @error('current_password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="update_password_password" class="form-label">كلمة المرور الجديدة</label>
                                <input type="password" id="update_password_password" name="password" class="form-control" autocomplete="new-password">
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="update_password_password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                @if (session('status') === 'password-updated')
                                    <span class="text-success ms-3">تم الحفظ.</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- قسم معلومات الملف الشخصي -->
                <div class="card mb-6">
                    <h5 class="card-header">معلومات الملف الشخصي</h5>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" class="mt-6">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-warning">
                                            عنوان بريدك الإلكتروني غير مُحقق منه.
                                            <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">انقر هنا لإعادة إرسال بريد التحقق.</button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                            <p class="text-success">تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني.</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                @if (session('status') === 'profile-updated')
                                    <span class="text-success ms-3">تم الحفظ.</span>
                                @endif
                            </div>
                        </form>

                        <!-- نموذج إرسال التحقق (غير مرئي) -->
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
                    <!-- قسم حذف الحساب -->
                    <div class="card mb-6">
                        <h5 class="card-header">حذف الحساب</h5>
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <h5 class="alert-heading mb-1">هل أنت متأكد أنك تريد حذف حسابك؟</h5>
                                <p class="mb-0">بمجرد حذف حسابك، لن يكون هناك عودة. الرجاء التأكد قبل المتابعة.</p>
                            </div>
                            <form id="formAccountDeactivation" onsubmit="return false">
                                <div class="form-check my-3">
                                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
                                    <label class="form-check-label" for="accountActivation">أؤكد رغبتني في حذف الحساب</label>
                                </div>
                                <button type="submit" class="btn btn-danger deactivate-account" disabled>حذف الحساب</button>
                            </form>
                        </div>
                    </div>
    <!-- / Content -->


    <div class="content-backdrop fade"></div>
</div>

@endsection