import React, {useState} from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UsersListTable from "../../features/user/UsersListTable.tsx";
import {Link} from "react-router-dom";
import UsersListFilters from "../../services/api/filters/UsersListFilters.tsx";
import UsersSearchForm from "../../features/user/UsersSearchForm.tsx";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import UserPreviewCard from "../../features/user/UserPreviewCard.tsx";
import UserApiGateway from "../../services/api/gateway/UserApiGateway.tsx";
import UserDTO from "../../services/api/dtos/UserDTO.tsx";

const UsersPage: React.FC = () => {
    const defaultFilters:UsersListFilters = { ids: null, username: null, email: null, status: null, type: null, limit: 25 };
    const [filters, setFilters] = useState<UsersListFilters>(defaultFilters)
    const [refreshKey, setRefreshKey] = useState(0)
    const [userPreview, setUserPreview] = useState<UserDTO|null>(null);

    const handleDisplayUserPreview = async (userId: number) => {
        const preview = await UserApiGateway.getOneUser(String(userId));
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
            <h2>
                Users list
            </h2>

            <div className={"margin-bottom-s"}>
                <UsersSearchForm defaultFilters={filters} callbackFunction={handleUsersSearch}/>
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={websiteRoutes.user.create}>Create New User</Link>
            </div>

            <div>
                <div className={"float-left two-thirds-width"}>
                    <UsersListTable filters={filters} refreshKey={refreshKey} mainLinkClickCallback={handleDisplayUserPreview}/>
                </div>

                <div className={"float-right one-thirds-width"}>
                    {userPreview && (
                        <UserPreviewCard user={userPreview} displayReadActions={true} displayWriteActions={false}/>
                    )}
                </div>
            </div>
        </AdminLayout>
    );
}

export default UsersPage;