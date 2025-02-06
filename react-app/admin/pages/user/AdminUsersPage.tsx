import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import AdminUsersListTable from "app/admin/features/user/AdminUsersListTable.tsx";
import {Link} from "react-router-dom";
import UsersListFilters from "app/admin/services/api/filters/UsersListFilters.tsx";
import AdminUsersSearchForm from "app/admin/features/user/AdminUsersSearchForm.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import AdminUserPreviewCard from "app/admin/features/user/AdminUserPreviewCard.tsx";
import UserApiGateway from "app/common/services/api/gateway/UserApiGateway.tsx";
import UserDTO from "app/common/services/api/dtos/UserDTO.tsx";
import AdminUserLifecycleCard from "app/admin/features/user/AdminUserLifecycleCard.tsx";

const AdminUsersPage: React.FC = () => {
    const defaultFilters = new UsersListFilters();
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
                <AdminUsersSearchForm defaultFilters={filters} callbackFunction={handleUsersSearch}/>
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={adminRoutes.user.create}>Create New User</Link>
            </div>

            <div>
                <div className={"float-left two-thirds-width"}>
                    <AdminUsersListTable filters={filters} refreshKey={refreshKey}
                                         mainLinkClickCallback={handleDisplayUserPreview} />
                </div>

                <div className={"float-right one-thirds-width"}>
                    {userPreview && (
                        <>
                            <AdminUserPreviewCard user={userPreview} displayReadActions={true}/>
                            <AdminUserLifecycleCard user={userPreview} />
                        </>
                    )}
                </div>
            </div>
        </AdminLayout>
    );
}

export default AdminUsersPage;