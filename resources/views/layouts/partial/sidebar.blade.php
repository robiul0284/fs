<div class="sidebar" data-color="blue" data-image="{{ asset('backend/img/sidebar-1.jpg') }}">

    <div class="logo">
        <a href="{{ route('admin.dashboard')}}" class="simple-text">
            Faysal Store
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ Request::is('admin/dashboard*') ? 'active': '' }}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard/ড্যাশবোর্ড</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/category*') ? 'active': '' }}">
                <a href="{{route('category.index')}}">
                    <i class="material-icons">category</i>
                    <p>Category/বিভাগ</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/product*') ? 'active': '' }}">
                <a href="{{route('product.index')}}">
                    <i><img src="https://img.icons8.com/material-outlined/24/000000/shopping-basket-2.png"></i>
                    <p>Products/পণ্য</p>
                </a>
            </li>

            <li class="{{ Request::is('admin/purchase*') ? 'active': '' }}">
                <a href="{{route('purchase.index')}}">
                    <i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/buy.png"></i>
                    <p>purchase/ক্রয়</p>
                </a>
            </li>

            <li class="{{ Request::is('admin/sale*') ? 'active': '' }}">
                <a href="{{route('sale.index')}}">
                    <i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/checkout.png"></i>
                    <p>sales/ক্রয়</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/cash*') ? 'active': '' }}">
                <a href="{{route('cash.index')}}">

                    <i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/money.png"></i>
                    <p>Cash/নগদ</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/bank*') ? 'active': '' }}">
                <a href="{{route('bank.index')}}">

                    <i class="material-icons">account_balance</i>
                    <p>Bank/ব্যাংক</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/expanse*') ? 'active': '' }}">
                <a href="{{route('expanse.index')}}">

                    <i class="material-icons"> explicit</i>
                    <p>Expanse/ব্যয়</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/pretty/cash*') ? 'active': '' }}">
                <a href="{{route('pretty.cash.index')}}">

                    <i class="material-icons">
                        money
                    </i>
                    <p>Pretty Cash/নগদ</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/payable*') ? 'active': '' }}">
                <a href="{{route('payable.index')}}">
                    <i class="material-icons">assessment</i>
                    <p>Report/প্রতিবেদন</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/payable*') ? 'active': '' }}">
                <a href="{{route('payable.index')}}">
                    <i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/initiate-money-transfer.png"></i>
                    <p>Payable/প্রাপ্য হিসাব</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/receivable*') ? 'active': '' }}">
                <a href="{{route('receivable.index')}}">
                    <i class="material-icons"><img src="https://img.icons8.com/carbon-copy/50/000000/cash-in-hand--v2.png"></i>
                    <p>Receivable/পাওনার হিসাব</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/godown*') ? 'active': '' }}">
                <a href="{{route('godown.index')}}">
                    <i class="material-icons">storefront</i>
                    <p>Godowns/গুদাম</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/inventory*') ? 'active': '' }}">
                <a href="{{ route('inventory.index') }}">
                    <i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/grocery-shelf.png"></i>
                    <p>Inventory/ইনভেন্টরি</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/customer*') ? 'active': '' }}">
                <a href="{{ route('customer.index') }}">
                    <i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/gender-neutral-user.png"></i>
                    <p>Customer/ক্রেতা</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/supplier*') ? 'active': '' }}">
                <a href="{{ route('supplier.index') }}">
                    <i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/supplier.png"></i>
                    <p>Supplier/সরবরাহকারী</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/account*') ? 'active': '' }}">
                <a href="{{ route('account.index') }}">
                    <i class="material-icons">account_tree</i>
                    <p>Accounts/হিসাবের নাম</p>
                </a>
            </li>
        </ul>
    </div>
</div>
