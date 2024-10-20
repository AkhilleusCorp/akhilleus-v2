import React, {useState} from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import {Link} from "react-router-dom";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import EquipmentsListFilters from "app/services/api/filters/EquipmentsListFilters.tsx";
import EquipmentDTO from "app/services/api/dtos/EquipmentDTO.tsx";
import EquipmentPreviewCard from "app/features/equipment/EquipmentPreviewCard.tsx";
import EquipmentsSearchForm from "app/features/equipment/EquipmentsSearchForm.tsx";
import EquipmentsListTable from "app/features/equipment/EquipmentsListTable.tsx";
import EquipmentApiGateway from "app/services/api/gateway/EquipmentApiGateway.tsx";

const EquipmentsPage: React.FC = () => {
    const defaultFilters = new EquipmentsListFilters();
    const [filters, setFilters] = useState<EquipmentsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)
    const [equipmentPreview, setUserPreview] = useState<EquipmentDTO|null>(null);

    const handleDisplayUserPreview = async (equipmentId: number) => {
        const preview = await EquipmentApiGateway.getOneEquipment(String(equipmentId));
        setUserPreview(preview);
    }

    const handleEquipmentsSearch = (filtersFromForm: EquipmentsListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <AdminLayout>
            <h2>
                Equipments list
            </h2>

            <div className={"margin-bottom-s"}>
                <EquipmentsSearchForm defaultFilters={defaultFilters} callbackFunction={handleEquipmentsSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={websiteRoutes.equipment.create}>Create New Equipment</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                <EquipmentsListTable filters={filters} refreshKey={refreshKey} mainLinkClickCallback={handleDisplayUserPreview}/>
            </div>

            <div className={"float-left padding-left-m one-thirds-width"}>
                {equipmentPreview && (
                    <EquipmentPreviewCard equipment={equipmentPreview} displayReadActions={true} displayWriteActions={false}/>
                )}
            </div>
        </AdminLayout>
    )
}

export default EquipmentsPage;