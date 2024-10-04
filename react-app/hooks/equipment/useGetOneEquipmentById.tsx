import {useEffect, useState} from "react";
import EquipmentApiGateway from "../../services/api/gateway/EquipmentApiGateway.tsx";
import EquipmentDTO from "../../services/api/dtos/EquipmentDTO.tsx";

function useGetOneEquipmentById(equipmentId: string|undefined): EquipmentDTO | null {
    if (!equipmentId) {
        return null;
    }

    const [equipment, setEquipment] = useState<EquipmentDTO | null>(null);
    useEffect(() => {
        const fetchEquipment = async () => {
            const equipment = await EquipmentApiGateway.getOneEquipment(equipmentId);
            setEquipment(equipment);
        }

        fetchEquipment();
    }, [equipmentId]);

    return equipment;
}

export default useGetOneEquipmentById;