import React, {useState} from 'react';
import UserAPI from "../../api/UserApi.tsx";
import {useNavigate} from "react-router-dom";

type UserCreateType = {
    login: string;
    email: string;
    plainPassword: string;
}

const UserCreateFormWidget: React.FC = () => {
    const [userCreate, setUserCreate] = useState<UserCreateType>({login: '', email: '', plainPassword: ''});
    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
            setUserCreate({
                ...userCreate,
                [event.target.name]: event.target.value
            });
    }

    const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        try {
            const user = await UserAPI.createUser(userCreate);
            navigate('/users/'+user.id);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>Login</label>
                <input type={"text"} name={"login"} required={true} onChange={handleInputChange}/>
            </div>
            <div>
                <label>Email</label>
                <input type={"email"} name={"email"} required={true} onChange={handleInputChange}/>
            </div>
            <div>
                <label>Password</label>
                <input type={"text"} name={"plainPassword"} required={true} onChange={handleInputChange}/>
            </div>
            <div>
                <button type={"button"} className={"btn-cancel"} onClick={() => navigate(-1)}>Cancel</button>
                <button type={"submit"} className={"btn-validate"}>Save</button>
            </div>
        </form>
    )
}

export default UserCreateFormWidget;