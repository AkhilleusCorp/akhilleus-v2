import React, {useState} from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UsersListAsTableWidget from "../../widget/user/UsersListAsTableWidget.tsx";
import {Link} from "react-router-dom";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import UsersSearchFormWidget from "../../widget/user/UsersSearchFormWidget.tsx";

const UsersPage: React.FC = () => {
    const [filters, setFilters] = useState<UsersListFilters>({ id: null, login: null, email: null, limit: 25 })
    const [refreshKey, setRefreshKey] = useState(0)

    const handleUsersSearch = (filtersFromForm: UsersListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <AdminLayout>
            <h1>Users List</h1>
            <div className={"margin-bottom-s"}>
                <Link to="/users/new">Create User</Link>
            </div>

            <div className={"margin-bottom-s"}>
                <UsersSearchFormWidget defaultFilters={filters} callbackFunction={handleUsersSearch}/>
            </div>

            <div className={"half-width"}>
            <UsersListAsTableWidget filters={filters} refreshKey={refreshKey} />
            </div>
        </AdminLayout>
    );
}

export default UsersPage;