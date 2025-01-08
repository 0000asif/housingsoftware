<style>
    .metismenu li a {
        color: white !important;
    }

    .metismenu li a i {
        color: white !important;
    }

    #sidebar {
        background-color: green;
    }

    .sidebar-menu li.mm-active {
        background-color: #1a8d1a !important;
    }

    .sidebar-menu a:focus,
    .sidebar-menu a:hover {
        background-color: #5bb05b !important;
    }

    .sidebar-menu a {
        font-family: "Tiro Bangla", serif;
        font-size: 16px;
    }
</style>

<!-- BEGIN: Sidebar-->
<div class="page-sidebar custom-scroll" id="sidebar">
    <div class="sidebar-header"><a class="sidebar-brand" href="{{ URL::to('dashboard') }}">IT Plan BD</a><a
            class="sidebar-brand-mini" href="index.html">Rd</a><span class="sidebar-points"><span
                class="badge badge-success badge-point mr-2"></span><span
                class="badge badge-danger badge-point mr-2"></span><span
                class="badge badge-warning badge-point"></span></span></div>
    <ul class="sidebar-menu metismenu">
        {{-- <li class="heading"><span>DASHBOARDS</span></li> --}}
        <li class=""><a href="{{ URL::to('/dashboard') }}">
                <i class="sidebar-item-icon ft-home"></i><span class="nav-label">
                    ড্যাশবোর্ড</span></a>
        </li>


        <li><a href="{{ URL::to('house') }}"><i class="sidebar-item-icon ft-edit"></i> বিল্ডিং</a></li>
        <li><a href="{{ URL::to('floor') }}"><i class="sidebar-item-icon ft-edit"></i> ফ্লোর </a></li>

        <li><a href="{{ URL::to('unit') }}"><i class="sidebar-item-icon ft-edit"></i> ইউনিট/রুম </a></li>


        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">পেমেন্ট মেথড
                </span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">
                <li><a href="{{ route('payment_method.create') }}">এড করুন</a></li>
                <li><a href="{{ route('payment_method.index') }}">সকল মেথডগুলি</a></li>
            </ul>
        </li>





        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">ভাড়াটিয়া পরিচালনা
                </span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">

                <li><a href="{{ URL::to('renter') }}">ভাড়াটিয়া </a></li>
                <li><a href="{{ URL::to('rent') }}">ভাড়া প্রদান</a></li>
            </ul>
        </li>

        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">ভাড়া
                    জেনারেট</span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">

                {{-- <li><a href="{{ Route('adminRentIncreaseDecrease') }}">ভাড়া
                        বৃদ্ধি/কমানো </a></li> --}}
                <li><a href="{{ Route('singleRentCollection.create') }}">ভাড়া
                        জেনারেট(সিঙ্গেল)</a></li>
                <li><a href="{{ Route('all.rentcreate') }}">ভাড়া
                        জেনারেট(সকল)</a></li>
                <li><a href="{{ Route('singleRentCollection.index') }}">পেন্ডিং ভাড়া </a></li>
            </ul>
        </li>


        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">কালেকশন</span><i
                    class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">

                <li><a href="{{ Route('adminRentIncreaseDecrease') }}"> ভাড়া বৃদ্ধি/কমানো</a></li>
                <li><a href="{{ Route('rentcollection.create') }}"> ভাড়া কালেকশন</a></li>
                <li><a href="{{ Route('colletion.history') }}">ভাড়া কালেকশনের তালিকা</a></li>
            </ul>
        </li>


        <li>
            <a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">আয়/ ব্যায়</span><i
                    class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">
                <li><a href="{{ route('IEcategory.index') }}">ক্যাটাগরি</a></li>
                <li><a href="{{ Route('income.index') }}">আয়</a></li>
                <li><a href="{{ route('expence.index') }}">ব্যায়</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">এইচ আর
                    মানেজমেন্ট</span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">
                <li><a href="{{ route('designation.index') }}">পদবী</a></li>
                <li><a href="{{ Route('employee.index') }}">স্টাফ </a></li>
                <li><a href="{{ URL::to('salary/create') }}">বেতন প্রদান</a></li>
                <li><a href="{{ URL::to('salary') }}">বেতনের রেকর্ড</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">নোট</span><i
                    class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">
                <li><a href="{{ route('remainder.create') }}">এড করুন</a></li>
                <li><a href="{{ Route('remainder.index') }}">নোট পরিচালনা </a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">লেজার </span><i
                    class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">
                <li><a href="{{ route('renter.ledger.index') }}">লেজার এগ্রিমেন্ট </a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">ব্যাংক
                    ট্রানজেকশন</span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">
                <li><a href="{{ route('bankTransaction.create') }}">ক্যাশ টু ব্যাংক </a></li>
                <li><a href="{{ route('banktocash') }}">ব্যাংক টু ক্যাশ </a></li>
                <li><a href="{{ Route('bankTransaction.index') }}">ব্যাংক পরিচালনা করুন</a></li>
            </ul>
        </li>


        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">রিপোর্ট </span><i
                    class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">
                <li><a href="{{ Route('income.report') }}">আয় রিপোর্ট</a></li>
                <li><a href="{{ Route('expense.report') }}">ব্যায় রিপোর্ট</a></li>
                <li><a href="{{ Route('salary.report') }}">বেতন রিপোর্ট</a></li>
                <li><a href="{{ Route('collection.report') }}">কালেকশন রিপোর্ট</a></li>
                <li><a href="{{ Route('due.report') }}">বাকি রিপোর্ট</a></li>
                <li><a href="{{ Route('rent.report') }}">ভাড়া রিপোর্ট</a></li>
            </ul>
        </li>

        {{-- Abdullah project coaching --}}

        {{--      <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">
                    Gallary</span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">

                <li><a href="{{ Route('photo_gallery.create') }}">Add photo</a></li>
                <li><a href="{{ Route('photo_gallery.index') }}">All Photo</a></li>

                <li><a href="{{ Route('video_gallery.create') }}">Add Video</a></li>
                <li><a href="{{ Route('video_gallery.index') }}">All Video</a></li>
            </ul>
        </li>

        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">
                    Notice</span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">

                <li><a href="{{ Route('notice.create') }}">Add Notice</a></li>
                <li><a href="{{ Route('notice.index') }}">All Notice</a></li>
            </ul>
        </li>

        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">
                    Syllabus</span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">

                <li><a href="{{ Route('syllabus.create') }}">Add Syllabus</a></li>
                <li><a href="{{ Route('syllabus.index') }}">All syllabus</a></li>
            </ul>
        </li>

        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">
                    Routine</span><i class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">

                <li><a href="{{ Route('routine.create') }}">Add Routine</a></li>
                <li><a href="{{ Route('routine.index') }}">All Routine</a></li>
            </ul>
        </li>

        <li><a href="{{ URL::to('setting') }}"><i class="sidebar-item-icon ft-edit"></i>Setting</a></li> 

        <li><a href="javascript:;"><i class="sidebar-item-icon ft-edit"></i><span class="nav-label">Phonebook</span><i
                    class="arrow la la-angle-right"></i></a>
            <ul class="nav-2-level">
                <li><a href="{{ URL::to('phonebook') }}">All Phonebook</a></li>
                <li><a href="{{ URL::to('datatables') }}">Datatable</a></li>
            </ul>
        </li> --}}


    </ul>
</div><!-- END: Sidebar-->
