"use client";

import React, { useEffect, useState } from "react";
import axios from 'axios';

const http = axios.create({
    baseURL: 'http://localhost:8000',
    withCredentials: true,
});

const Pens = () => {
    const [pens, setPens] = useState([]);

    const getPens = async () => {
        const response = await fetch('http://localhost:8000/api/pens');
        const json = await response.json();
        setPens(json.data);
    }

    useEffect(() => {
        getPens();
    }, []);

    return (
        <div className="relative overflow-x-auto p-5">
            <table className="min-w-full divide-y dark:divide-neutral-700">
                <thead>
                    <tr>
                        <th scope="col" className="px-6 py-4">ID</th>
                        <th scope="col" className="px-6 py-4">名前</th>
                        <th scope="col" className="px-6 py-4">価格</th>
                        <th scope="col" className="px-3 py-4"></th>
                        <th scope="col" className="px-3 py-4"></th>
                    </tr>
                </thead>
                <tbody>
                    {
                        pens.map((pen: any) => {
                            return (
                                <tr key={pen.id} className="bg-white border-b">
                                    <th scope="row" className="px-6 py-2">{pen.id}</th>
                                    <td className="px-6 py-2">{pen.name}</td>
                                    <td className="px-6 py-2">{pen.price}円</td>
                                    <td className="px-3 py-2 text-right">
                                        <button
                                            className="px-2 py-1 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none"
                                            onClick={() => {}}
                                        >編集</button>
                                    </td>
                                    <td className="px-3 py-2">
                                        <button
                                            className="px-2 py-1 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none"
                                            onClick={()=>{}}
                                        >削除</button>
                                    </td>
                                </tr>
                            )
                        })
                    }
                </tbody>
            </table>
        </div>
    );
}

export default Pens;