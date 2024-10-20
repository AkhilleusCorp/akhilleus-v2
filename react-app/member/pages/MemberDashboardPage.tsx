import React from 'react';
import MemberLayout from "app/member/layouts/MemberLayout.tsx";

const MemberDashboardPage: React.FC = () => {

    return (
        <MemberLayout>
            <h1 className="text-3xl font-bold underline">
                <div>Member dashboard</div>
            </h1>
        </MemberLayout>
    );
}

export default MemberDashboardPage;