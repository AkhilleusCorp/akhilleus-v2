import React, {useState} from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UsersListTable from "../../widget/user/UsersListTable.tsx";
import {Link} from "react-router-dom";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import UsersSearchForm from "../../widget/user/UsersSearchForm.tsx";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import UserPreviewCard from "../../widget/user/UserPreviewCard.tsx";
import UserApiGateway from "../../api/gateway/UserApiGateway.tsx";
import UserDTO from "../../api/dtos/UserDTO.tsx";

const UsersPage: React.FC = () => {
    const defaultFilters:UsersListFilters = { ids: null, username: null, email: null, statuses: null, types: null, limit: 25 };
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
                        <UserPreviewCard user={userPreview} displayActions={true}/>
                    )}
                </div>
            </div>
        </AdminLayout>
    );
}

export default UsersPage;