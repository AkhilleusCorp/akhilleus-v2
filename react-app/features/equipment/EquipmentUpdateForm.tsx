import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import EquipmentApiGateway from "../../services/api/gateway/EquipmentApiGateway.tsx";
import EquipmentDTO from "../../services/api/dtos/EquipmentDTO.tsx";
import {TextField} from "@mui/material";

type EquipmentUpdateFormType = {
    equipment: EquipmentDTO,
}

const EquipmentUpdateForm: React.FC<EquipmentUpdateFormType> = ({equipment}) => {
    const navigate = useNavigate();
    const [equipmentUpdated, setEquipmentUpdated] = useState<EquipmentDTO>(equipment);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setEquipmentUpdated({
            ...equipmentUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            await EquipmentApiGateway.updateEquipment(equipment.id, equipmentUpdated);
            navigate(websiteRoutes.equipment.details(equipment.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                           name={"name"} value={equipmentUpdated.name} onChange={handleInputChange} />
            </div>
        </SaveForm>
    )
}

export default EquipmentUpdateForm;