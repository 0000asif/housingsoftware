@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Website setting</h5>
                <a href="{{ route('renter.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <!-- Logo -->
                                <div class="form-group col-4">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo"
                                        class="form-control @error('logo') is-invalid @enderror">
                                    @if ($setting->logo)
                                        <img src="{{ asset('image/setting/' . $setting->logo) }}" width="100"
                                            alt="Current Logo">
                                    @endif
                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Favicon -->
                                <div class="form-group  col-4">
                                    <label for="fav_icon">Favicon</label>
                                    <input type="file" name="fav_icon"
                                        class="form-control @error('fav_icon') is-invalid @enderror">
                                    @if ($setting->fav_icon)
                                        <img src="{{ asset('image/setting/' . $setting->fav_icon) }}" width="50"
                                            alt="Current Favicon">
                                    @endif
                                    @error('fav_icon')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Site Title -->
                                <div class="form-group col-4">
                                    <label for="site_title">Site Title *</label>
                                    <input type="text" name="site_title"
                                        class="form-control @error('site_title') is-invalid @enderror"
                                        value="{{ old('site_title', $setting->site_title) }}" required>
                                    @error('site_title')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Contact Information -->
                                <div class="form-group col-4">
                                    <label for="phone">Helpline Number *</label>
                                    <input type="text" name="helpline_number"
                                        class="form-control @error('helpline_number') is-invalid @enderror"
                                        value="{{ old('helpline_number', $setting->helpline_number) }}" required>
                                    @error('helpline_number')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Contact Information -->
                                <div class="form-group col-4">
                                    <label for="contract_number">Contract Number *</label>
                                    <input type="text" name="contract_number"
                                        class="form-control @error('contract_number') is-invalid @enderror"
                                        value="{{ old('contract_number', $setting->contract_number) }}" required>
                                    @error('contract_number')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-4">
                                    <label for="institute_email">Institute Email *</label>
                                    <input type="email" name="institute_email"
                                        class="form-control @error('institute_email') is-invalid @enderror"
                                        value="{{ old('institute_email', $setting->institute_email) }}" required>
                                    @error('institute_email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-4">
                                    <label for="principle_email">Principle Email *</label>
                                    <input type="email" name="principle_email"
                                        class="form-control @error('principle_email') is-invalid @enderror"
                                        value="{{ old('principle_email', $setting->principle_email) }}" required>
                                    @error('principle_email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-4">
                                    <label for="messenger_link">Messenger Link *</label>
                                    <input type="text" name="messenger_link"
                                        class="form-control @error('messenger_link') is-invalid @enderror"
                                        value="{{ old('messenger_link', $setting->messenger_link) }}" required>
                                    @error('messenger_link')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Social Links -->
                                <div class="form-group col-4">
                                    <label for="fb_link">Facebook Page Link *</label>
                                    <input type="text" name="fb_link"
                                        class="form-control @error('fb_link') is-invalid @enderror"
                                        value="{{ old('fb_link', $setting->fb_link) }}" required>
                                    @error('fb_link')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-4">
                                    <label for="instagram_link">Instagram Link *</label>
                                    <input type="text" name="instagram_link"
                                        class="form-control @error('instagram_link') is-invalid @enderror"
                                        value="{{ old('instagram_link', $setting->instagram_link) }}" required>
                                    @error('instagram_link')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-4">
                                    <label for="youtube_link">Youtube Link *</label>
                                    <input type="text" name="youtube_link"
                                        class="form-control @error('x_link') is-invalid @enderror"
                                        value="{{ old('youtube_link', $setting->youtube_link) }}" required>
                                    @error('youtube_link')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-4">
                                    <label for="linkedin">LinkedIn Link *</label>
                                    <input type="text" name="linkedin"
                                        class="form-control @error('linkedin') is-invalid @enderror"
                                        value="{{ old('linkedin', $setting->linkedin) }}" required>
                                    @error('linkedin')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Short Description -->
                                <div class="form-group col-6">
                                    <label for="short_description">Short Description *</label>
                                    <textarea name="short_description" id=""
                                        class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $setting->short_description) }}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Address and Map -->
                                <div class="form-group col-6">
                                    <label for="address">Address *</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address', $setting->address) }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-4">
                                    <label for="map">Map Embed Link</label>
                                    <input type="text" name="map"
                                        class="form-control @error('map') is-invalid @enderror"
                                        value="{{ old('map', $setting->map) }}">
                                    @error('map')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Meta Title -->
                                <div class="form-group col-4">
                                    <label for="meta_title">Meta Title *</label>
                                    <input type="text" name="meta_title"
                                        class="form-control @error('meta_title') is-invalid @enderror"
                                        value="{{ old('meta_title', $setting->meta_title) }}">
                                    @error('meta_title')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- meta url  --}}
                                <div class="form-group col-4">
                                    <label for="meta_url">Meta URL</label>
                                    <input type="text" name="meta_url"
                                        class="form-control @error('meta_url') is-invalid @enderror"
                                        value="{{ old('meta_url', $setting->meta_url) }}">
                                    @error('meta_url')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Meta descriptioin -->
                                <div class="form-group col-6">
                                    <label for="meta_description">Meta Descriptioin *</label>
                                    <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $setting->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Meta Keywords -->
                                <div class="form-group col-6">
                                    <label for="keywords">Meta Descriptioin *</label>
                                    <textarea name="keywords" class="form-control @error('keywords') is-invalid @enderror">{{ old('keywords', $setting->keywords) }}</textarea>
                                    @error('keywords')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <!-- Meta Image -->
                                <div class="form-group col-4">
                                    <label for="meta_img">Meta Image</label>
                                    <input type="file" name="meta_img"
                                        class="form-control @error('meta_img') is-invalid @enderror">
                                    @if ($setting->meta_img)
                                        <img src="{{ asset('image/setting/' . $setting->meta_img) }}" width="100"
                                            alt="Footer Background Image">
                                    @endif
                                    @error('meta_img')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Copyright Text -->
                                <div class="form-group col-8">
                                    <label for="copyright_text">Copyright Text *</label>
                                    <input type="text" name="copyright_text"
                                        class="form-control @error('copyright_text') is-invalid @enderror"
                                        value="{{ old('copyright_text', $setting->copyright_text) }}" required>
                                    @error('copyright_text')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- END: Page content-->
@endsection

@push('script')
    <script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush
