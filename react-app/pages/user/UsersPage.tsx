import React, {useState} from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UsersListTable from "../../widget/user/UsersListTable.tsx";
import {Link} from "react-router-dom";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import UsersSearchForm from "../../widget/user/UsersSearchForm.tsx";
import routes from "../../infrastructure/router/routes-mapping.tsx";
import UserDTO from "../../dtos/UserDTO.tsx";
import UserAPI from "../../api/UserApi.tsx";
import UserDetailsCard from "../../widget/user/UserDetailsCard.tsx";

const UsersPage: React.FC = () => {
    const [filters, setFilters] = useState<UsersListFilters>({ id: null, username: null, email: null, limit: 25 })
    const [refreshKey, setRefreshKey] = useState(0)
    const [userPreview, setUserPreview] = useState<UserDTO|null>(null);

    const handleDisplayUserPreview = async (userId: number) => {
        const preview = await UserAPI.getOneUser(String(userId));
        setUserPreview(preview);
    }

    const handleUsersSearch = (filtersFromForm: UsersListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <AdminLayout>
            <div>
                <div className={"margin-bottom-s"}>
                    <UsersSearchForm defaultFilters={filters} callbackFunction={handleUsersSearch}/>
                </div>
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={routes.userCreate}>Create New User</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                <UsersListTable filters={filters} refreshKey={refreshKey} displayUserPreview={handleDisplayUserPreview}/>
            </div>

            <div className={"float-left padding-left-m one-thirds-width "}>
                {userPreview && (
                    <UserDetailsCard user={userPreview} linkToDetails={true}/>
                )}
            </div>
        </AdminLayout>
    );
}

export default UsersPage;