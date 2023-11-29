@extends('layouts.app')
@section('content')
    <div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            <img src="assets/images/image-1.png" alt="" class="jarallax-img">
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    <h1 class="nk-title">Create Person</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-gap-4"></div>

    <!-- Login -->
    <div class="container">
        <div class="nk-gap-6"></div>
        <div class="nk-gap-2"></div>

        <div class="row vertical-gap lg-gap">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="nk-box-3 bg-dark-1">
                    <form class="nk-form nk-form-style-1" method="POST" action="code/code_createperson.php">
                        <input class="form-control" type="text" placeholder="Character Name" name="character_name"
                            id="character_name" value="" autocomplete="character_name" autofocus required>

                        <div class="nk-gap-2"></div>

                        <label for="character_class" class="form-label">Character Class</label>
                        <select class="form-select" name="character_class" id="character_class" required>
                            <option value="">Select an option</option>
                            <option value="dual_sword">Dual Sword</option>
                        </select>

                        <div class="nk-gap-2"></div>

                        <div class="nk-gap-2"></div>

                        <div class="form-check float-left">
                        </div>

                        <button class="nk-btn nk-btn-color-white link-effect-4 float-right" type="submit">Create</button>

                        <div class="clearfix"></div>
                        <div class="nk-gap-1"></div>
                    </form>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="nk-gap-6"></div>
        <div class="nk-gap-2"></div>

    </div>
@endsection
