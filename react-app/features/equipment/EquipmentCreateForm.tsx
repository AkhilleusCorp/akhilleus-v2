import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import websiteRoutes from "../../services/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import EquipmentApiGateway from "../../services/api/gateway/EquipmentApiGateway.tsx";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import SelectInput from "../../components/input/SelectInput.tsx";
import equipmentRegistries from "../../constants/equipmentRegistries.tsx";

type EquipmentCreateFormType = {
    name: string;
}

const EquipmentCreateForm: React.FC = () => {
    const [equipmentCreate, setEquipmentCreate] = useState<EquipmentCreateFormType>({name: ''});
    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setEquipmentCreate({
            ...equipmentCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent) => {
        setEquipmentCreate({
            ...equipmentCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            const equipment = await EquipmentApiGateway.createEquipment(equipmentCreate);
            navigate(websiteRoutes.equipment.details(equipment.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Name" variant="outlined" size="small"
                               name={"name"} required={true} onChange={handleInputChange}/>
                </FormControl>

                <SelectInput label="Status" name={"status"} value={null}
                             options={equipmentRegistries.status} required={true} onSelectChange={handleSelectChange}/>
            </Grid>
        </SaveForm>
    )
}

export default EquipmentCreateForm;