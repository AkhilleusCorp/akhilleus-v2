import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UsersListAsCardWidget from "../../widget/user/UsersListAsCardWidget.tsx";
import UsersListAsTableWidget from "../../widget/user/UsersListAsTableWidget.tsx";
import {useSearchParams} from "react-router-dom";
import UsersListFilters from "../../filters/UsersListFilters.tsx";

const UsersPage: React.FC = () => {
    const [searchParams] = useSearchParams();
    const display = searchParams.get('display') || 'table';
    const filters: UsersListFilters = { id: 2, login: '_1', email: null }

    return (
        <AdminLayout>
            <h1>Users Page</h1>

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