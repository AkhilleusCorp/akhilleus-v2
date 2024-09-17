import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UsersListAsCardWidget from "../../widget/user/UsersListAsCardWidget.tsx";
import UsersListAsTableWidget from "../../widget/user/UsersListAsTableWidget.tsx";
import {Link, useSearchParams} from "react-router-dom";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import UsersSearchFormWidget from "../../widget/user/UsersSearchFormWidget.tsx";

const UsersPage: React.FC = () => {
    const [searchParams] = useSearchParams();
    const display = searchParams.get('display') || 'table';
    const filters: UsersListFilters = { id: null, login: null, email: null, limit: 50 }

    return (
        <AdminLayout>
            <h1>Users Page</h1>
            <Link to="/users/new">Create User</Link>

            <UsersSearchFormWidget />

            { display == 'card' && (
                <UsersListAsCardWidget filters={filters} />
            )}

            { display == 'table' && (
                <UsersListAsTableWidget filters={filters} />
            )}
        </AdminLayout>
    );
}

export default UsersPage;