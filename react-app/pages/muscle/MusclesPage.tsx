import React, {useState} from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import {Link} from "react-router-dom";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import MusclesListFilters from "app/services/api/filters/MusclesListFilters.tsx";
import MuscleDTO from "app/services/api/dtos/MuscleDTO.tsx";
import MusclePreviewCard from "app/features/muscle/MusclePreviewCard.tsx";
import MusclesSearchForm from "app/features/muscle/MusclesSearchForm.tsx";
import MusclesListTable from "app/features/muscle/MusclesListTable.tsx";
import MuscleApiGateway from "app/services/api/gateway/MuscleApiGateway.tsx";

const MusclesPage: React.FC = () => {
    const defaultFilters = new MusclesListFilters();
    const [filters, setFilters] = useState<MusclesListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)
    const [musclePreview, setUserPreview] = useState<MuscleDTO|null>(null);

    const handleDisplayUserPreview = async (muscleId: number) => {
        const preview = await MuscleApiGateway.getOneMuscle(String(muscleId));
        setUserPreview(preview);
    }

    const handleMusclesSearch = (filtersFromForm: MusclesListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <AdminLayout>
            <h2>
                Muscles list
            </h2>

            <div className={"margin-bottom-s"}>
                <MusclesSearchForm defaultFilters={defaultFilters} callbackFunction={handleMusclesSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={websiteRoutes.muscle.create}>Create New Muscle</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                <MusclesListTable filters={filters} refreshKey={refreshKey} mainLinkClickCallback={handleDisplayUserPreview}/>
            </div>

            <div className={"float-left padding-left-m one-thirds-width"}>
                {musclePreview && (
                    <MusclePreviewCard muscle={musclePreview} displayReadActions={true} displayWriteActions={false}/>
                )}
            </div>
        </AdminLayout>
    )
}

export default MusclesPage;