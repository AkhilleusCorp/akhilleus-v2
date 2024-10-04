import {useEffect, useState} from "react";
import EquipmentsListFilters from "../../services/api/filters/EquipmentsListFilters.tsx";
import EquipmentApiGateway from "../../services/api/gateway/EquipmentApiGateway.tsx";
import EquipmentDTO from "../../services/api/dtos/EquipmentDTO.tsx";

function useGetManyEquipmentsByParams(filters: EquipmentsListFilters, refreshKey: number): EquipmentDTO[] {
    const [equipments, setEquipments] = useState<EquipmentDTO[]>([]);
    useEffect(() => {
        const fetchEquipments = async () => {
            const equipments= await EquipmentApiGateway.getManyEquipments(filters);
            setEquipments(equipments);
        }

        fetchEquipments();
    }, [refreshKey]);

    return equipments;
}

export default useGetManyEquipmentsByParams;