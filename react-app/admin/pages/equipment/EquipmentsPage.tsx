import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {Link} from "react-router-dom";
import websiteRoutes from "app/admin/services/router/websiteRoutes.tsx";
import EquipmentsListFilters from "app/admin/services/api/filters/EquipmentsListFilters.tsx";
import EquipmentDTO from "app/admin/services/api/dtos/EquipmentDTO.tsx";
import EquipmentPreviewCard from "app/admin/features/equipment/EquipmentPreviewCard.tsx";
import EquipmentsSearchForm from "app/admin/features/equipment/EquipmentsSearchForm.tsx";
import EquipmentsListTable from "app/admin/features/equipment/EquipmentsListTable.tsx";
import EquipmentApiGateway from "app/admin/services/api/gateway/EquipmentApiGateway.tsx";

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