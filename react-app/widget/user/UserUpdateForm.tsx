import React from 'react';
import {useNavigate} from "react-router-dom";
import UserDTO from "../../dtos/UserDTO.tsx";
import {useState} from "react";
import UserAPI from "../../api/UserApi.tsx";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import SaveForm from "../common/form/SaveForm.tsx";

type UserEditFormType = {
    user: UserDTO,
}

const UserEditForm: React.FC<UserEditFormType> = ({user}) => {
    const navigate = useNavigate();
    const [userUpdated, setUserUpdated] = useState<UserDTO>(user);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
            setUserUpdated({
                ...userUpdated,
                [event.target.name]: event.target.value
            });
    }

    const handleSubmit = async () => {
        try {
            await UserAPI.updateUser(user.id, userUpdated);
            navigate(websiteRoutes.user.details(user.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <label>Username</label>
                <input type={"text"} name={"username"} value={userUpdated.username} onChange={handleInputChange} required={true}/>
            </div>
            <div>
                <label>Email</label>
                <input type={"email"} name={"email"} value={userUpdated.email} onChange={handleInputChange} required={true}/>
            </div>
        </SaveForm>
    )
}

export default UserEditForm;